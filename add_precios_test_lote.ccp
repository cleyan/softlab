<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="precios_test" dataSource="precios_test" errorSummator="Error" wizardCaption="Agregar/Editar Precios Test " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" activeCollection="TableParameters" activeTableType="dataSource" removeParameters="test_id" PathID="precios_test">
			<Components>
				<Hidden id="9" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="precio_test_id" fieldSource="precio_test_id" required="False" caption="Precio Test Id" wizardCaption="Precio Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="precios_testprecio_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" wizardTheme="Inline" wizardThemeType="File" defaultValue="0" PathID="precios_testtest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="13" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="prevision_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" visible="Yes" PathID="precios_testprevision_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="24" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="procedencia_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" visible="Yes" PathID="precios_testprocedencia_id">
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
				<ListBox id="11" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_base_id" required="False" caption="Prevision Id" wizardCaption="Prevision Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" sourceType="Table" connection="Datos" dataSource="previsiones" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_prevision" boundColumn="prevision_id" textColumn="nom_prevision" visible="Yes" PathID="precios_testprevision_base_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Hidden id="30" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="ayuda_1" wizardTheme="Inline" wizardThemeType="File" defaultValue="'Hola mundo'" PathID="precios_testayuda_1">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="33"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="31" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="titulo_ayuda_1" wizardTheme="Inline" wizardThemeType="File" defaultValue="'titulo'" PathID="precios_testtitulo_ayuda_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="32" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="icono_ayuda_1" wizardTheme="Inline" wizardThemeType="File" PathID="precios_testicono_ayuda_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="12" fieldSourceType="DBColumn" dataType="Float" html="False" editable="True" hasErrorCollection="True" name="factor" required="True" caption="factor" wizardCaption="Precio" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="precios_testfactor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="22" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_test" wizardTheme="Inline" wizardThemeType="File" defaultValue="'Buscar test --&gt;'" visible="Yes" PathID="precios_testnom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="seccion_id" wizardTheme="Inline" wizardThemeType="File" sourceType="Table" connection="Datos" dataSource="secciones" boundColumn="seccion_id" textColumn="nom_seccion" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_seccion" defaultValue="0" visible="Yes" PathID="precios_testseccion_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="nom_seccion" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="16" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="equipo_id" wizardTheme="Inline" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_equipo" defaultValue="0" visible="Yes" PathID="precios_testequipo_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="21" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" removeParameters="test_id" returnPage="menu_principal.ccp" PathID="precios_testButton_Insert">
					<Components/>
					<Events>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" removeParameters="test_id" returnPage="add_precios_test_lote.ccp" PathID="precios_testButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="29" conditionType="Parameter" useIsNull="True" field="precio_test_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="precio_test_id" orderNumber="1"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="add_precios_test_lote.php" comment="//" codePage="utf-8" forShow="True" url="add_precios_test_lote.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="add_precios_test_lote_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="34" groupID="16"/>
		<Group id="35" groupID="17"/>
		<Group id="36" groupID="18"/>
		<Group id="37" groupID="19"/>
		<Group id="38" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="39"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
