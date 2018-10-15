<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="NewRecord1" wizardTheme="InLine" wizardThemeType="File" actionPage="importar_precios" errorSummator="Error" wizardFormMethod="post" PathID="NewRecord1">
			<Components>
				<FileUpload id="8" fieldSourceType="DBColumn" allowedFileMasks="*.upd" fileSizeLimit="100000" dataType="Text" tempFileFolder="TEMP" name="archivo" wizardTheme="InLine" wizardThemeType="File" required="True" PathID="NewRecord1archivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<ListBox id="4" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="prevision_id" wizardTheme="None" wizardThemeType="File" sourceType="Table" connection="Datos" dataSource="previsiones" boundColumn="prevision_id" textColumn="nom_prevision" required="True" caption="Procedencia" visible="Yes" PathID="NewRecord1prevision_id">
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
				<ListBox id="9" fieldSourceType="DBColumn" sourceType="Table" dataType="Integer" editable="True" hasErrorCollection="True" returnValueType="Number" name="procedencia_id" wizardTheme="InLine" wizardThemeType="File" wizardEmptyCaption="Seleccionar Valor" connection="Datos" dataSource="procedencias" boundColumn="procedencia_id" textColumn="nom_procedencia" required="True" caption="Procedencia" visible="Yes" PathID="NewRecord1procedencia_id">
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
				<RadioButton id="12" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" editable="True" returnValueType="Number" name="creartest" wizardTheme="InLine" wizardThemeType="File" required="True" _valueOfList="F" _nameOfList="No, omitir Test Faltantes" dataSource="V;Sí, crear un test no encontrado;F;No, omitir Test Faltantes" visible="Yes" PathID="NewRecord1creartest">
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
				</RadioButton>
				<RadioButton id="17" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" html="True" editable="True" returnValueType="Number" name="eliminarlistas" wizardTheme="InLine" wizardThemeType="File" _valueOfList="2" _nameOfList="No, sólo la que estoy importando" dataSource="1;Si, Todas;2;No, sólo la que estoy importando" required="True" caption="Condición de eliminación de listas" visible="Yes" PathID="NewRecord1eliminarlistas">
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
				</RadioButton>
				<Button id="5" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" wizardTheme="None" wizardThemeType="File" operation="Insert" wizardCaption="Agregar" PathID="NewRecord1Button_Insert">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="11"/>
							</Actions>
						</Event>
					</Events>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="importar_precios.php" comment="//" codePage="utf-8" forShow="True" url="importar_precios.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="importar_precios_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="13" groupID="17"/>
		<Group id="14" groupID="18"/>
		<Group id="15" groupID="19"/>
		<Group id="16" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="18"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
