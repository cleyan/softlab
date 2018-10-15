<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="configuracionSearch" wizardCaption="Buscar Configuracion " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="configuracion.ccp" PathID="configuracionSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" visible="Yes" PathID="configuracionSearchs_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="configuracionSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
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
		<EditableGrid id="2" urlType="Relative" secured="True" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="configuracion" connection="Datos" dataSource="configuracion" pageSizeLimit="100" wizardCaption="Lista de Configuracion " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" wizardUsePageScroller="True" activeCollection="TableParameters" activeTableType="dataSource" PathID="configuracion">
			<Components>
				<Sorter id="9" visible="True" name="Sorter_descripcion" column="descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="descripcion" PathID="configuracionSorter_descripcion">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="8" visible="True" name="Sorter_valor" column="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="valor" PathID="configuracionSorter_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" editable="True" hasErrorCollection="True" name="descripcion" fieldSource="descripcion" required="False" caption="Descripcion" wizardCaption="Descripcion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="10" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="valor" fieldSource="valor" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Seleccionar Valor" connection="Datos" _nameOfList="--" dataSource=";--" required="True" visible="Yes" PathID="configuracionvalor">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="16" tableName="configuracion" posWidth="100" posHeight="163" posLeft="10" posTop="10"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="17" tableName="configuracion" fieldName="valores"/>
					</Fields>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Hidden id="19" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valores" wizardTheme="Inline" wizardThemeType="File" fieldSource="valores" PathID="configuracionvalores">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="20" type="Simple" name="Navigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="True" wizardHideDisabled="True" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardFirstText="Inicio" wizardPrevText="Anterior" wizardNextText="Siguiente" wizardLastText="Final" wizardOfText="de" wizardTheme="InLine" wizardThemeType="File" wizardImagesScheme="Square" size="10" pageSizes="1;5;10;25;50" PathID="configuracionNavigator1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="13" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="configuracionButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="14" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="15" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" returnPage="menu_principal.ccp" PathID="configuracionCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="18"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="descripcion" parameterSource="s_descripcion" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="31" conditionType="Parameter" useIsNull="False" field="valores" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="''" orderNumber="2"/>
				<TableParameter id="32" conditionType="Parameter" useIsNull="True" field="valores" dataType="Text" searchConditionType="NotEqual" parameterType="Expression" logicOperator="And" parameterSource="NULL" orderNumber="3"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="6" tableName="configuracion" fieldName="configuracion_id" dataType="Integer"/>
			</PKFields>
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
			<SecurityGroups>
				<Group id="26" groupID="16" read="True"/>
				<Group id="27" groupID="17" read="True"/>
				<Group id="28" groupID="18" read="True" update="True"/>
				<Group id="29" groupID="19" read="True" update="True"/>
				<Group id="30" groupID="20" read="True" insert="True" update="True" delete="True"/>
			</SecurityGroups>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="configuracion_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="configuracion.php" comment="//" codePage="utf-8" forShow="True" url="configuracion.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="21" groupID="16"/>
		<Group id="22" groupID="17"/>
		<Group id="23" groupID="18"/>
		<Group id="24" groupID="19"/>
		<Group id="25" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="33"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
