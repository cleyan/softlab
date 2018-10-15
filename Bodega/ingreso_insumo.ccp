<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Bodega" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="insumos_ingreso" dataSource="insumos_ingreso" errorSummator="Error" wizardCaption="Agregar/Editar Insumos Ingreso " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="list_ingreso_insumos.ccp" PathID="insumos_ingreso">
			<Components>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="ingreso_insumo_id" fieldSource="ingreso_insumo_id" required="False" caption="Ingreso Insumo Id" wizardCaption="Ingreso Insumo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="insumos_ingresoingreso_insumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_insumo" wizardTheme="Inline" wizardThemeType="File" PathID="insumos_ingresonom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="last_insumo_id" wizardTheme="Inline" wizardThemeType="File" PathID="insumos_ingresolast_insumo_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="10" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="insumo_id" fieldSource="insumo_id" required="True" caption="Insumo" wizardCaption="Insumo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="insumos" boundColumn="insumo_id" textColumn="nom_insumo" visible="Yes" PathID="insumos_ingresoinsumo_id">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<TextBox id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="cantidad" fieldSource="cantidad" required="True" caption="Cantidad" wizardCaption="Cantidad" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumos_ingresocantidad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="12" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha" fieldSource="fecha" required="True" caption="Fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="GetFechaServer()" visible="Yes" PathID="insumos_ingresofecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="14" fieldSourceType="DBColumn" dataType="Memo" html="False" editable="True" hasErrorCollection="True" name="descripcion" fieldSource="descripcion" required="False" caption="Descripción" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" visible="Yes" PathID="insumos_ingresodescripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="15" fieldSourceType="DBColumn" dataType="Float" html="False" editable="True" hasErrorCollection="True" name="costo" fieldSource="costo" required="False" caption="Costo" wizardCaption="Costo" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumos_ingresocosto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" returnPage="list_ingreso_insumos.ccp" PathID="insumos_ingresoButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" returnPage="list_ingreso_insumos.ccp" removeParameters="ingreso_insumo_id" PathID="insumos_ingresoButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="5" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" returnPage="list_ingreso_insumos.ccp" removeParameters="ingreso_insumo_id" PathID="insumos_ingresoButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="6" message="¿Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="list_ingreso_insumos.ccp" removeParameters="ingreso_insumo_id" PathID="insumos_ingresoButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="ingreso_insumo_id" parameterSource="ingreso_insumo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<IncludePage id="25" hasOperation="True" name="calendar_tag" wizardTheme="InLine" wizardThemeType="File" page="calendar_tag.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ingreso_insumo.php" comment="//" codePage="utf-8" forShow="True" url="ingreso_insumo.php"/>
		<CodeFile id="Events" language="PHPTemplates" name="ingreso_insumo_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="20" groupID="16"/>
		<Group id="21" groupID="17"/>
		<Group id="22" groupID="18"/>
		<Group id="23" groupID="19"/>
		<Group id="24" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="26"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
